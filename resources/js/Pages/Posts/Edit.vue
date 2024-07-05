<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
              <h1>Edit Post</h1>
  
              <form @submit.prevent="submit" class="needs-validation" novalidate>
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input id="title" v-model="form.title" type="text" class="form-control" required>
                  <div v-if="form.errors.title" class="invalid-feedback">{{ form.errors.title }}</div>
                </div>
                <div class="mb-3">
                  <label for="content" class="form-label">Content</label>
                  <textarea id="content" v-model="form.content" class="form-control" rows="5" required></textarea>
                  <div v-if="form.errors.content" class="invalid-feedback">{{ form.errors.content }}</div>
                </div>
                <div class="mb-3">
                  <label for="category_id" class="form-label">Category</label>
                  <select id="category_id" v-model="form.category_id" class="form-select" required>
                    <option v-for="category in categories" :value="category.id" :key="category.id">
                      {{ category.name }}
                    </option>
                  </select>
                  <div v-if="form.errors.category_id" class="invalid-feedback">{{ form.errors.category_id }}</div>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input id="image" type="file" @change="handleFileChange" class="form-control">
                  <div v-if="form.errors.image" class="invalid-feedback">{{ form.errors.image }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
  
              <Link :href="route('posts.index')" class="btn btn-secondary mt-3">Back to Posts</Link>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const { props } = usePage();
const post = ref(props.post);
const categories = ref(props.categories);

// Initializing form with default values from the post prop
const form = useForm({
  title: post.value.title,
  content: post.value.content,
  category_id: post.value.category_id,
  image: null,
});

const handleFileChange = (e) => {
  form.image = e.target.files[0];
};

const submit = () => {
    const formData = new FormData();
  formData.append('title', form.title);
  formData.append('content', form.content);
  formData.append('category_id', form.category_id);
  if (form.image) {
    formData.append('image', form.image);
  }

  form.post(route('posts.update', post.value.id), {
    data: formData,
    headers: {
      'Content-Type': 'multipart/form-data',
    },
    onSuccess: () => {
      alert('Post updated successfully.');
    },
    onError: (errors) => {
      console.error('Error updating post:', errors);
      alert('Failed to update post.');
    },
  });
};
</script>
