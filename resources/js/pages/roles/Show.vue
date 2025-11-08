<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import roles from '@/routes/roles';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show the role',
        href: '/roles/show',
    },
];
interface Permission{
    id: number,
    name: string,
}
interface props{
    role: Object,
    rolePermissions: Permission[],
}
const props = defineProps<props>();

</script>

<template>
    <Head title="Show the role" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Card class="my-8 mx-auto max-w-sm p-8">
            <div class="text-center">
                <strong>All Permissions:</strong>
            </div>
            <p><strong>Name: </strong>{{role.name }}</p>
            <p><strong>Permissions: </strong>
                <span 
                v-for="permission in rolePermissions"
                key="1"
                class="text-green-800 px-2.5 py-2.5">
                {{ permission }}
                </span>            
            </p>
            <div class="text-center">
                <Link :href="roles.index()"><Button>Home</Button></Link>
            </div>
        </Card>
    </AppLayout>
</template>
