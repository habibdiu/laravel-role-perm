<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Card from '@/components/ui/card/Card.vue';
import Button from '@/components/ui/button/Button.vue';
import users from '@/routes/users';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show a user',
        href: '/users/show',
    },
];
defineProps<{
    user:{
        id: number,
        name: string,
        email: string,
    }
}>();

</script>

<template>
    <Head title="Show a user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Card class="my-8 mx-auto max-w-sm p-8">
            <div>
                <strong>About: </strong> <u>{{ user.name }}</u>
            </div>
            <p><strong>Name: </strong>{{ user.name }}</p>
            <p><strong>Email: </strong>{{ user.email }}</p>
            <div class="text-center">
                <Link :href="users.index()"><Button>Home</Button></Link>
            </div>
        </Card>

        
    </AppLayout>
</template>