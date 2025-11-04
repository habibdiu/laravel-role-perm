<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Link, Head } from '@inertiajs/vue3';
import { create } from '@/routes/users';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];
interface User{
    id: number;
    name: string;
    email: string;
}
interface props{
    users: User[];
}
const props = defineProps<props>();
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mt-3">
                <Link :href="create()" class="bg-green-500"> <Button>Add User</Button></Link>
            </div>
            <Table class="table">
                <TableHeader>
                    <TableRow>
                    <TableHead>ID</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Email</TableHead>
                    <TableHead class="text-center">Action</TableHead>
                    
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in props.users" :key="user.id">
                    <TableCell>{{ user.id }}</TableCell>
                    <TableCell  className="font-medium">{{ user.name }}</TableCell>
                    <TableCell>{{ user.email }}</TableCell>
                    <TableCell class="text-center space-x-2">
                        <Button class="bg-green-500">Edit</Button>
                        <Button class="bg-red-600">Delete</Button>
                    </TableCell>

                    </TableRow>
                </TableBody>
            </Table>    
        </div>
    </AppLayout>
</template>