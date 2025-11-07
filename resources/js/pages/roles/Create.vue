<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import roles, { create,index, store } from '@/routes/roles';
import { Link, useForm } from '@inertiajs/vue3'
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create a role',
        href: '/roles/create',
    },
];
const form = useForm({
  name: '',
})

</script>

<template>
    <Head title="Create a role" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <form @submit.prevent="form.post(roles.store())" class="w-4/12 space-y-4">
                <div class="space-y-2">
                    <Label for="role name">Name</Label>
                    <Input type="text" v-model="form.name" placeholder="Enter Name"></Input>
                    <div v-if="form.errors.name" class="text-red-500">{{ form.errors.name }}</div>
                </div>

                <div>
                    <Button class="mr-4" type="submit" :disabled="form.processing">Add Role</Button>
                    <Link :href="roles.index()"><Button>Back</Button></Link>
                </div>
            </form>
            </div>
    </AppLayout>
</template>
