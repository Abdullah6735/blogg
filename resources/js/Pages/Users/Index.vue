<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <Link href="/users/create" class="btn btn-primary mb-3">Add New User</Link>

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <td class="px-4 py-2">{{ user.name }}</td>
                    <td class="px-4 py-2">{{ user.email }}</td>
                    <td class="px-4 py-2">
                        <template v-if="user.id !== props.auth.user.id">
                      <Link :href="`/users/${user.id}/edit`" class="btn btn-warning btn-sm mr-2">Edit</Link>
                      <form @submit.prevent="deleteUser(user.id)" style="display:inline;">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </template>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import { Link, usePage } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Inertia } from '@inertiajs/inertia';

  const { props } = usePage();
  const users = props.users;

  const deleteUser = (userId) => {
    if (confirm('Are you sure you want to delete this user?')) {
      Inertia.delete(route('users.destroy', userId));
    }
  };
  </script>
