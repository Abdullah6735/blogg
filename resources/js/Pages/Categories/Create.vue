<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Category</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h1>Add New Category</h1>
              
              <form @submit.prevent="submit">
                <div class="mb-4">
                  <label for="name" class="form-label">Category Name</label>
                  <input type="text" id="name" v-model="form.name" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Category</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Initialize form using useForm
const form = useForm({
  name: '',
});

// Handle form submission
const submit = () => {
  form.post('/categories', {
    onSuccess: () => {
      form.reset(); // Reset the form after successful submission
      alert('Category added successfully.');
      // Inertia.visit('/categories'); // Navigate to the categories index page
    },
    onError: (errors) => {
      console.error('Error adding category:', errors);
      alert('Failed to add category.');
    },
  });
};
  </script>
  