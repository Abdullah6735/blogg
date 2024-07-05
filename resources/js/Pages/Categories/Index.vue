<template>
  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6">
                      <h1>Categories</h1>

                      <!-- Button for adding new category -->
                      <Link href="/categories/create" class="btn btn-dark mb-4">Add New Category</Link>

                      <!-- Table for listing categories -->
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="category in categories" :key="category.id">
                                  <td>{{ category.id }}</td>
                                  <td>{{ category.name }}</td>
                                  <td>
                                      <!-- Action buttons: Update, Delete -->
                                      <Link :href="`/categories/${category.id}/edit`" class="btn btn-sm btn-warning mr-2">Edit</Link>
                                      <button @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</button>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Extracting props from Inertia
const { props } = usePage();
console.log('Props:', props);

// Accessing categories
const categories = props.categories || [];
console.log('Categories:', categories);

// Function to delete category
const deleteCategory = async (categoryId) => {
  if (confirm('Are you sure you want to delete this category?')) {
    try {
      await Inertia.delete(`/categories/${categoryId}`);
      alert('Category deleted successfully.');
    } catch (error) {
      console.error('Error deleting category:', error);
      alert('Failed to delete category.');
    }
  }
};
</script>
