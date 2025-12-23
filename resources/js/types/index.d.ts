import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface Feed {
    id: number;
    user_id: number;
    user: User;
    type: 'post' | 'event' | 'project_update' | 'social';
    content: string;
    title?: string;
    event_date?: string;
    images?: string[];
    file_attachment?: string[];
    is_pinned: boolean;
    is_followed: boolean;
    likes_count: number;
    comments_count: number;
    created_at: string;
    updated_at: string;
}
