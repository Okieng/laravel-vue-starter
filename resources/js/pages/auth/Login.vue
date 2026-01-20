<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <div class="font-display bg-background-light dark:bg-background-dark 
        text-slate-900 dark:text-slate-100 min-h-screen flex items-center justify-center">
        <div class="flex flex-col lg:flex-row w-full min-h-screen">

            <div class="hidden lg:flex lg:w-1/2 bg-pattern relative items-center justify-center p-12 overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none">
                    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-400 rounded-full blur-3xl opacity-30"></div>
                </div>

                <div class="relative z-10 max-w-lg text-white">
                    <div class="mb-8">
                        <img src="https://logo-teka.com/wp-content/uploads/2025/06/bitrix24-logo-eng.png">
                    </div>

                    <!-- <h1 class="text-5xl font-bold text-white leading-tight mb-6">
                        Bitrix28
                    </h1> -->

                    <p class="text-xl text-blue-100 opacity-90 leading-relaxed mb-8">
                        Achievment, Teamwork, Engagment, Adaptive, Motivation!
                    </p>

                </div>
            </div>

            <!-- RIGHT LOGIN PANEL -->
            <div
                class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 md:p-20 bg-white dark:bg-slate-900">
                <div class="w-full max-w-md">

                    <!-- LOGO MOBILE -->
                    <div class="lg:hidden flex justify-center mb-8">
                        <div class="flex items-center space-x-2 text-primary">
                            <img
                                src="https://play-lh.googleusercontent.com/9wuW06QVjtlO-SlAlqiamfIWzBvYF5NGRAgrZJpts52CNQnPGZwXVegvQDa-bn8yqf4=w480-h960-rw">
                        </div>
                    </div>

                    <div class="mb-10 text-center lg:text-left">
                        <h2 class="text-5xl font-bold mb-2">Selamat Datang!</h2>
                        <p class="text-slate-500 dark:text-slate-400">
                            Please enter your credentials to access the platform.
                        </p>
                    </div>

                    <!-- ========== INERTIA FORM ========== -->
                    <Form v-bind="store.form()" :reset-on-success="['password']" v-slot="{ errors, processing }"
                        class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold mb-1.5" for="email">
                                Work Email Address
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="0.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </div>

                                <Input id="email" type="email" name="email" required autocomplete="email"
                                    placeholder="name@company.com" class="pl-11 py-3" />

                                <InputError :message="errors.email" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-semibold" for="password">Password</label>

                                <TextLink v-if="canResetPassword" :href="request()" class="text-primary text-sm">
                                    Forgot password?
                                </TextLink>
                            </div>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="0.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>

                                </div>

                                <Input id="password" type="password" name="password" required
                                    autocomplete="current-password" placeholder="••••••••" class="pl-11 py-3" />

                                <InputError :message="errors.password" />
                            </div>
                        </div>

                        <!-- Remember -->
                        <div class="flex items-center">
                            <Checkbox id="remember" name="remember" class="mr-2" />
                            <label for="remember" class="text-sm">
                                Stay logged in
                            </label>
                        </div>

                        <!-- Submit -->
                        <Button type="submit"
                            class="w-full bg-primary hover:bg-slate-600 text-white font-semibold py-3.5 rounded-lg shadow-lg shadow-blue-500/20 transition-all duration-200 active:scale-[0.98]"
                            :disabled="processing">
                            <Spinner v-if="processing" />
                            Log In
                        </Button>
                    </Form>

                    <!-- Register -->
                    <div class="mt-8 text-center text-sm">
                        <p class="text-slate-500 dark:text-slate-400">
                            Belum punya akun?
                            <TextLink v-if="canRegister" :href="register()" class="text-primary font-semibold">
                                Hubungi Divisi IT
                            </TextLink>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
