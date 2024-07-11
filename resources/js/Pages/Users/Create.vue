<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create User</h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h1>Create User</h1>
              <form @submit.prevent="submit">
                <div class="mb-4">
                  <label for="name" class="form-label">Name</label>
                  <input id="name" v-model="form.name" type="text" class="form-control" required autofocus />
                  <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
                </div>

                <div class="mb-4">
                  <label for="email" class="form-label">Email</label>
                  <input id="email" v-model="form.email" type="email" class="form-control" required />
                  <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
                </div>

                <div class="mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input id="password" v-model="form.password" type="password" class="form-control" required />
                  <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
                </div>

                <div class="mb-4">
                  <label for="roles" class="form-label">Roles</label>
                  <select id="roles" v-model="form.roles" class="form-select" multiple required>
                    <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                  </select>
                  <div v-if="form.errors.roles" class="text-danger">{{ form.errors.roles }}</div>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import { useForm } from '@inertiajs/vue3';
  import { defineProps } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

  defineProps({
    roles: {
      type: Array,
      required: true,
    },
  });

  const form = useForm({
    name: '',
    email: '',
    password: '',
    roles: [],
  });

  const submit = () => {
    form.post(route('users.store'), {
      onSuccess: () => form.reset(),
    });
  };
  </script>
