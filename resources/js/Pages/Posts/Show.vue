<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post Details</h2>
        </template>

        <div class="py-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h1>{{ post.title }}</h1>
                            </div>
                            <div class="card-body">
                                <p class="mb-4" style="white-space: pre-wrap;">{{ post.content }}</p>
                                <img :src="getImageUrl(post.image)" alt="Post Image" class="img-fluid mb-4" v-if="post.image">
                                <Link :href="route('posts.index')" class="btn btn-primary mt-4">Back to Posts</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { usePage, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Extracting props from Inertia
const { props } = usePage();
const post = props.post || {};

const getImageUrl = (imagePath) => {
    return imagePath ? `/storage/${imagePath}` : '';
};
</script>
