<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Table from '@/components/ui/table/Table.vue';
import TableBody from '@/components/ui/table/TableBody.vue';
import TableCell from '@/components/ui/table/TableCell.vue';
import TableHead from '@/components/ui/table/TableHead.vue';
import TableHeader from '@/components/ui/table/TableHeader.vue';
import TableRow from '@/components/ui/table/TableRow.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import roles, { create } from '@/routes/roles';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { Eye, Pencil, Trash } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: '/roles',
    },
];
interface Role{
    id: number,
    name: string,
    permissions: string,
}
interface props{
    role: Role[]
}

const props= defineProps<props>();

function deleteRole(id: number){
    if(confirm("Are you sure want to delete role ?")){
        router.delete(roles.destroy(id));
    }
}
</script>

<template>
    <Head title="Roles" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <div class="mt-3 mb-3">
                <Link :href="create()" class="bg-green-500"> <Button>Add role</Button></Link>
            </div>
            <Table class="table">
                <TableHeader>
                    <TableRow>
                    <TableHead>ID</TableHead>
                    <TableHead>Name</TableHead>
                    <TableHead>Permisssions</TableHead>
                    <TableHead class="text-center">Action</TableHead>
                    
                    </TableRow>
                </TableHeader>
                <TableBody> 
                    <TableRow v-for="role in props.role" :key="role.id">
                    <TableCell>{{ role.id }}</TableCell>
                    <TableCell  className="font-medium">{{ role.name }}</TableCell>
                    <TableCell>
                        <span v-for="permission in role.permissions"
                        class="mr-1 text-green-800 bg-gary-600 px-2.5 py-2.5">
                            {{ permission.name }}
                        </span>
                    </TableCell>
                    <TableCell class="text-center space-x-2">
                        <Link :href="roles.show(role.id)"><Button class="bg-blue-600"><Eye /></Button></Link>
                        <Link :href="roles.edit(role.id)"><Button class="bg-green-600"><Pencil /></Button></Link>
                        <Button @click="deleteRole(role.id)" class="bg-red-600"><Trash /></Button>
                    </TableCell>

                    </TableRow>
                </TableBody>
            </Table>    
        </div>
    </AppLayout>
</template>
