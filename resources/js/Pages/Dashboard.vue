<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref, onMounted, reactive, computed } from 'vue';
let teachers = ref([]);
    onMounted(() => {
        let vm = this;
        axios.get('/api/get-teachers', {
            params: {
                school_id: 16
            }
        })
        .then((res) => {
            teachers.value = res.data.teachers;
        })
        .catch((error) => {
            console.log(error);
        })
    })
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div
                            v-for="teacher in teachers"
                            :key="teacher.id"
                        >
                            {{ teacher.fname }} {{ teacher.lname }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
