<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import users, { create,index } from '@/routes/users';
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
const form = useForm({
  name: '',
  email: '',
  password: '',
})
</script>

<template>
    <Head title="Create a user" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form class="w-4/12 space-y-4">
                <div class="space-y-2">
                    <Label for="user name">Name</Label>
                    <Input type="text" v-model="form.name"></Input>
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                </div>
                
                <div class="space-y-2">
                    <Label for="use r email">Email</Label>
                    <Input type="text" v-model="form.email"></Input>
                    <div v-if="form.errors.email">{{ form.errors.email }}</div>
                </div>
                
                <div class="space-y-2">
                    <Label for="user password">Password</Label>
                    <Input type="password" v-model="form.password"></Input>                
                    <div v-if="form.errors.password">{{ form.errors.password }}</div>
                </div>

                <div>
                    <Button class="mr-4" type="submit" :disabled="form.processing">Create</Button>
                    <Link :href="users.index()"><Button>Back</Button></Link>
                </div>
            </form>
            </div>
    </AppLayout>
</template>
