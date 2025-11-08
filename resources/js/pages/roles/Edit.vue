<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';
import { Checkbox } from "@/components/ui/checkbox";
import roles from '@/routes/roles';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit a role',
        href: '/roles/edit',
    },
];
interface Permission{
    id: number,
    name: string,
}
interface props{
    role: Object,
    permissions: Permission[],
    rolePermissions: Permission[],
}
const props = defineProps<props>();

const form = useForm({
  name: props.role.name,
  permissions: props.rolePermissions || [],

})

</script>

<template>
    <Head title="Edit a role" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="form.put(roles.update(props.role.id))" class="w-4/12 space-y-4">
                <div class="space-y-2">
                    <Label for="role name">Name</Label>
                    <Input type="text" v-model="form.name" placeholder="Enter Name"></Input>
                    <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
                </div>

                <div>
                    <div class="flex flex-col gap-6">

                        Permissions:
                        <label v-for="permission in permissions"
                        class="flex item-center space-x-2">
                        <input 
                        :value="permission"
                        v-model="form.permissions"
                        type="checkbox"
                        >
                        <span class="capitalize">{{ permission }}</span>

                        </label>                  
                        <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
                    </div>
                </div>

                <div>
                    <Button class="mr-4" type="submit" :disabled="form.processing">Update Role</Button>
                    <Link :href="roles.index()"><Button>Back</Button></Link>
                </div>
            </form>
            </div>
    </AppLayout>
</template>
