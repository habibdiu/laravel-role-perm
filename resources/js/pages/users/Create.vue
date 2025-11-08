<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import users, { create,index, store } from '@/routes/users';
import { Link, useForm } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create a user',
        href: '/users/create',
    },
];
interface Role{
    id: number,
    name: string,
}
interface props{
    roles: Role[],
}
const props = defineProps<props>();

const form = useForm({
  name: '',
  email: '',
  password: '',
  roles: [],
})

</script>

<template>
    <Head title="Create a user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="form.post(users.store())" class="w-4/12 space-y-4">
                <div class="space-y-2">
                    <Label for="user name">Name</Label>
                    <Input type="text" v-model="form.name" placeholder="Enter Name"></Input>
                    <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
                </div>
                
                <div class="space-y-2">
                    <Label for="use r email">Email</Label>
                    <Input type="email" v-model="form.email" placeholder="users email"></Input>
                    <div v-if="form.errors.email" class="text-red-500">{{ form.errors.email }}</div>
                </div>
                
                <div class="space-y-2">
                    <Label for="user password">Password</Label>
                    <Input type="password" v-model="form.password" placeholder="use strong unique password"></Input>                
                    <div v-if="form.errors.password" class="text-red-500">{{ form.errors.password }}</div>
                </div>

                <div class="flex flex-col gap-6">

                    Roles:
                    <label v-for="role in roles"
                    class="flex item-center space-x-2">
                    <input 
                    :value="role"
                    v-model="form.roles"
                    type="checkbox"
                    >
                    <span class="capitalize">{{ role }}</span>

                    </label>                  
                    <div v-if="form.errors.roles" class="text-red-500">{{ form.errors.roles }}</div>
                </div>

                <div>
                    <Button class="mr-4" type="submit" :disabled="form.processing">Add User</Button>
                    <Link :href="users.index()"><Button>Back</Button></Link>
                </div>
            </form>
            </div>
    </AppLayout>
</template>
