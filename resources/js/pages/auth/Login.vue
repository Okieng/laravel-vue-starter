<script setup lang="ts">
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { Eye, EyeOff } from 'lucide-vue-next';

defineProps<{ status?: string; canResetPassword: boolean; canRegister: boolean; }>();

const passwordVisible = ref(false);
const togglePassword = () => {
    passwordVisible.value = !passwordVisible.value;
};
</script>

<template>
    <div class="font-sans bg-background text-foreground min-h-screen flex items-center justify-center">

        <Head title="Log In" />
        <div class="flex flex-col lg:flex-row w-full min-h-screen">

            <!-- LEFT PANEL: BRANDING & PATTERN -->
            <div
                class="hidden lg:flex lg:w-1/2 bg-primary relative items-center justify-center p-12 overflow-hidden shadow-2xl">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 opacity-30 pointer-events-none">
                    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/20 rounded-full blur-3xl animate-pulse">
                    </div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-400/30 rounded-full blur-3xl"></div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(circle_at_center,var(--color-primary-foreground)_0%,transparent_70%)] opacity-10">
                    </div>
                </div>

                <div class="relative z-10 max-w-lg text-white text-center flex flex-col items-center">
                    <div class="mb-10 transition-transform duration-700 hover:scale-105">
                        <img src="https://logo-teka.com/wp-content/uploads/2025/06/bitrix24-logo-eng.png"
                            alt="Bitrix24 Logo"
                            class="h-16 w-auto drop-shadow-xl animate-[bounce_3s_infinite_ease-in-out]">
                    </div>

                    <p class="text-2xl text-blue-100 font-medium opacity-90 leading-relaxed mb-4 tracking-tight">
                        Achievement • Teamwork • Engagement
                    </p>
                    <p class="text-xl text-blue-200/80 italic leading-relaxed">
                        Adaptive & Motivation
                    </p>
                </div>
            </div>

            <!-- RIGHT LOGIN PANEL -->
            <div
                class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 md:p-20 bg-white dark:bg-slate-900">
                <div class="w-full max-w-md">

                    <!-- LOGO MOBILE -->
                    <div class="lg:hidden flex justify-center mb-10">
                        <div class="flex items-center p-4 bg-primary/5 rounded-2xl">
                            <img src="https://play-lh.googleusercontent.com/9wuW06QVjtlO-SlAlqiamfIWzBvYF5NGRAgrZJpts52CNQnPGZwXVegvQDa-bn8yqf4=w480-h960-rw"
                                alt="Mobile Logo" class="h-12 w-auto">
                        </div>
                    </div>

                    <div class="mb-10 text-center lg:text-left">
                        <h2 class="text-4xl sm:text-5xl font-extrabold mb-3 tracking-tight text-foreground">
                            Selamat Datang!
                        </h2>
                        <p class="text-muted-foreground text-lg">
                            Please enter your credentials to access the platform.
                        </p>
                    </div>

                    <!-- ========== INERTIA FORM ========== -->
                    <Form v-bind="store.form()" :reset-on-success="['password']" v-slot="{ errors, processing }"
                        class="space-y-6">
                        <!-- Email -->
                        <div class="space-y-2">
                            <Label for="email" class="text-sm font-semibold text-foreground">
                                Email Address
                            </Label>

                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>

                                <Input id="email" type="email" name="email" required autocomplete="email"
                                    placeholder="name@company.com" class="pl-11 py-6 text-base" />

                                <InputError :message="errors.email" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <Label for="password" class="text-sm font-semibold text-foreground">Password</Label>
                                <TextLink v-if="canResetPassword" :href="request()"
                                    class="text-primary text-sm font-medium hover:underline transition-all">
                                    Forgot password?
                                </TextLink>
                            </div>

                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground group-focus-within:text-primary transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </div>

                                <Input id="password" :type="passwordVisible ? 'text' : 'password'" name="password"
                                    required autocomplete="current-password" placeholder="••••••••"
                                    class="pl-11 pr-12 py-6 text-base" />

                                <button type="button" @click="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-muted-foreground hover:text-primary transition-colors focus:outline-none"
                                    aria-label="Toggle password visibility">
                                    <Eye v-if="!passwordVisible" class="size-5" />
                                    <EyeOff v-else class="size-5" />
                                </button>

                                <InputError :message="errors.password" />
                            </div>
                        </div>

                        <!-- Remember -->
                        <!-- <div class="flex items-center">
                            <Checkbox id="remember" name="remember" class="mr-2" />
                            <label for="remember" class="text-sm">
                                Stay logged in
                            </label>
                        </div> -->

                        <!-- Submit -->
                        <Button type="submit"
                            class="w-full h-12 bg-primary hover:bg-primary/90 text-white font-bold text-lg rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 active:scale-[0.97] disabled:opacity-70"
                            :disabled="processing">
                            <Spinner v-if="processing" class="mr-2" />
                            Log In
                        </Button>
                    </Form>

                    <!-- Register -->
                    <div class="mt-8 text-center">
                        <p class="text-muted-foreground text-sm">
                            Belum punya akun?
                            <TextLink v-if="canRegister" :href="register()"
                                class="text-primary font-bold hover:underline ml-1">
                                Hubungi Divisi IT
                            </TextLink>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
