<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Link, Head, router } from '@inertiajs/vue3';
import { create } from '@/routes/users';
import { Eye, Pencil,Route,Trash } from 'lucide-vue-next';
import { can } from '@/lib/can';
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
import users from '@/routes/users';

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
    roles: string,
}
interface props{
    users: User[];
}
const props = defineProps<props>();

function deleteUser(id: number){
    if(confirm("Are you sure want to delete this user ?")){
        router.delete((users.destroy(id)));
    }
}
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mt-3 mb-3" v-if="can('users.create')">
                <Link :href="create()" class="bg-green-500"> <Button>Add User</Button></Link>
            </div>
            <Table class="table">
                <TableHeader>
                    <TableRow>
                    <TableHead>ID</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Email</TableHead>
                    <TableHead>Roles</TableHead>
                    <TableHead class="text-center">Action</TableHead>
                    
                    </TableRow>
                </TableHeader>
                <TableBody> 
                    <TableRow v-for="user in props.users" :key="user.id">
                    <TableCell>{{ user.id }}</TableCell>
                    <TableCell  className="font-medium">{{ user.name }}</TableCell>
                    <TableCell>{{ user.email }}</TableCell>
                    <TableCell>
                        <span v-for="role in user.roles"
                        class="mr-1 text-green-800 px-2.5 py-2.5">
                            {{ role.name}}
                        </span>
                    </TableCell>
                    <TableCell class="text-center space-x-2">
                        <Link v-if="can('users.show')" :href="users.show(user.id)"><Button class="bg-blue-600"><Eye /></Button></Link>
                        <Link v-if="can('users.edit')" :href="users.edit(user.id)"><Button class="bg-green-600"><Pencil /></Button></Link>
                        <Button v-if="can('users.destroy')" @click="deleteUser(user.id)" class="bg-red-600"><Trash /></Button>
                    </TableCell>

                    </TableRow>
                </TableBody>
            </Table>    
        </div>
    </AppLayout>
</template>