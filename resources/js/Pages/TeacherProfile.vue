<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'; 
import { onMounted, ref } from 'vue';
const props = defineProps(['teacher_id']);
const teacher = ref({});

onMounted(() => {
    axios.get('/api/get-teacher', {
        params: {
            id: props.teacher_id
        }
    })
    .then((res) => {
        teacher.value = res.data
        console.log(teacher.value);
    })
})

</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ teacher.fname }} {{ teacher.lname }}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="h-64 grid grid-rows-3 grid-flow-col gap-4">
                            <div>{{ teacher.district }}</div>
                            <div>{{ teacher.school }}</div>
                            <div>{{ teacher.coachfname }} {{ teacher.coachlname }}</div>
                            <div>{{ teacher.grade }}</div>
                            <div>{{ teacher.subject }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>