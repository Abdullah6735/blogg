<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h1>Posts</h1>

                        <!-- Button for adding new post -->
                        <Link href="/posts/create" class="btn btn-dark mb-4">Add New Post</Link>

                        <!-- Table for listing posts -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in posts" :key="post.id">
                                    <td>{{ post.id }}</td>
                                    <td>{{ post.title }}</td>
                                    <td>
                                        <!-- Action buttons: Update, Delete -->
                                        <Link :href="`/posts/${post.id}/edit`" class="btn btn-sm btn-warning mr-2">Edit</Link>
                                        <button @click="deletePost(post.id)" class="btn btn-sm btn-danger">Delete</button>
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

// Accessing posts
const posts = props.posts || [];
console.log('Posts:', posts);

// Function to delete post
const deletePost = async (postId) => {
    if (confirm('Are you sure you want to delete this post?')) {
        try {
            await Inertia.delete(`/posts/${postId}`);
            alert('Post deleted successfully.');
        } catch (error) {
            console.error('Error deleting post:', error);
            alert('Failed to delete post.');
        }
    }
};
</script>
