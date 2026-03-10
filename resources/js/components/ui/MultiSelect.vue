<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { Check, ChevronsUpDown, X } from 'lucide-vue-next';
import { cn } from '@/lib/utils';

interface Option {
    label: string;
    value: string | number;
    [key: string]: any;
}

const props = withDefaults(defineProps<{
    modelValue: (string | number)[];
    options: any[];
    placeholder?: string;
    labelKey?: string;
    valueKey?: string;
    class?: string;
}>(), {
    placeholder: 'Select items...',
    labelKey: 'label',
    valueKey: 'value',
    modelValue: () => [],
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);
const containerRef = ref<HTMLDivElement | null>(null);
const search = ref('');

const toggle = () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        search.value = '';
    }
};

const close = (e: MouseEvent) => {
    if (containerRef.value && !containerRef.value.contains(e.target as Node)) {
        isOpen.value = false;
        search.value = '';
    }
};

onMounted(() => {
    document.addEventListener('click', close);
});

onUnmounted(() => {
    document.removeEventListener('click', close);
});

const filteredOptions = computed(() => {
    if (!search.value) return props.options;
    const lowerSearch = search.value.toLowerCase();
    return props.options.filter(option =>
        String(option[props.labelKey]).toLowerCase().includes(lowerSearch)
    );
});

const isSelected = (value: string | number) => {
    return props.modelValue.includes(value);
};

const toggleOption = (value: string | number) => {
    const newValue = [...props.modelValue];
    const index = newValue.indexOf(value);

    if (index === -1) {
        newValue.push(value);
    } else {
        newValue.splice(index, 1);
    }

    emit('update:modelValue', newValue);
};

const displayValue = computed(() => {
    if (props.modelValue.length === 0) return props.placeholder;

    // Find selected options
    const selected = props.options.filter(opt => props.modelValue.includes(opt[props.valueKey]));

    if (selected.length === 0) return props.placeholder;

    if (selected.length <= 2) {
        return selected.map(s => s[props.labelKey]).join(', ');
    }

    return `${selected.length} selected`;
});
</script>

<template>
    <div class="relative w-full" ref="containerRef">
        <div @click="toggle" :class="cn(
            'flex min-h-[36px] items-center justify-between rounded-md border border-input bg-transparent px-3 py-2 text-sm shadow-sm placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-ring disabled:cursor-not-allowed disabled:opacity-50 cursor-pointer',
            props.class
        )">
            <div class="flex flex-wrap gap-1 max-w-[calc(100%-24px)]">
                <span v-if="modelValue.length === 0" class="text-muted-foreground">{{ placeholder }}</span>
                <span v-else class="truncate">{{ displayValue }}</span>
            </div>
            <ChevronsUpDown class="h-4 w-4 opacity-50 shrink-0" />
        </div>

        <div v-if="isOpen"
            class="absolute z-50 min-w-[8rem] w-full overflow-hidden rounded-md border bg-popover text-popover-foreground shadow-md animate-in fade-in-80 mt-1">
            <div class="flex items-center border-b px-3" v-if="options.length > 5">
                <input v-model="search"
                    class="flex h-10 w-full rounded-md bg-transparent py-3 text-sm outline-none placeholder:text-muted-foreground disabled:cursor-not-allowed disabled:opacity-50"
                    placeholder="Search..." />
            </div>
            <div class="max-h-[200px] overflow-auto p-1">
                <div v-for="option in filteredOptions" :key="option[valueKey]" @click="toggleOption(option[valueKey])"
                    :class="cn(
                        'relative flex cursor-pointer select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50',
                        isSelected(option[valueKey]) ? 'bg-accent/50' : ''
                    )">
                    <div class="mr-2 flex h-4 w-4 items-center justify-center rounded-sm border border-primary"
                        :class="isSelected(option[valueKey]) ? 'bg-primary text-primary-foreground' : 'opacity-50 [&_svg]:invisible'">
                        <Check class="h-3 w-3" />
                    </div>
                    <span>{{ option[labelKey] }}</span>
                </div>
                <div v-if="filteredOptions.length === 0" class="py-6 text-center text-sm text-muted-foreground">
                    No results found.
                </div>
            </div>
        </div>
    </div>
</template>
