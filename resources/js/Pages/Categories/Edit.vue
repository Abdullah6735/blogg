<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <h1>Edit Category</h1>

            <form @submit.prevent="submit" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input id="name" v-model="form.name" type="text" class="form-control" required>
                <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <Link :href="route('categories.index')" class="btn btn-secondary mt-3">Back to Categories</Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const category = props.category || {};

const form = useForm({
  name: category.name,
});

const submit = () => {
  form.put(route('categories.update', category.id));
};
</script>
