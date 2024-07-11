<template>
    <AuthenticatedLayout>
        <template #header>
            <Head title="Edit User" />
        </template>

        <div class="container mt-5">
            <h1 class="mb-4">Edit User</h1>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="form-control"
                        id="name"
                        :class="{ 'is-invalid': form.errors.name }"
                        required
                    />
                    <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        id="email"
                        :class="{ 'is-invalid': form.errors.email }"
                        required
                    />
                    <div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password (leave blank to keep current password)</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="form-control"
                        id="password"
                        :class="{ 'is-invalid': form.errors.password }"
                    />
                    <div v-if="form.errors.password" class="invalid-feedback">{{ form.errors.password }}</div>
                </div>

                <div class="mb-3">
                    <label for="roles" class="form-label">Roles</label>
                    <select
                        v-model="form.roles"
                        multiple
                        class="form-select"
                        id="roles"
                        :class="{ 'is-invalid': form.errors.roles }"
                        required
                    >
                        <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                    </select>
                    <div v-if="form.errors.roles" class="invalid-feedback">{{ form.errors.roles }}</div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <Link :href="route('users.index')" class="btn btn-secondary ms-2">Cancel</Link>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    user: Object,
    roles: Array,
    userRoles: Array,
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    roles: props.userRoles,
});

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onSuccess: () => {
            form.reset('password');
        },
        onError: (errors) => {
            console.error(errors);
        },
    });
};
</script>

<style scoped>
.invalid-feedback {
    display: block;
}
</style>
