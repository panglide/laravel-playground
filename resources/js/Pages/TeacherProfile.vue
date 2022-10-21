<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3'; 
import { onMounted, ref, computed } from 'vue';
const props = defineProps(['teacher_id']);
const teacher = ref({});

onMounted(() => {
    axios.get('/api/get-teacher', {
        params: {
            id: props.teacher_id
        }
    })
    .then((res) => {
        teacher.value = res.data;
    })
})

const grade = computed(() => {

    switch (teacher.value.grade) {
        case 0:
            return 'Kindergarten';
            break;
        case 1:
            return 'First';
            break;
        case 2:
            return 'Second';
            break;
        case 3:
            return 'Third';
            break;
        case 4:
            return 'Fourth';
            break;
        case 5:
            return 'Fifth';
            break;
        case 6:
            return 'Sixth';
            break;
        }
    })
const subject = computed(() => {

switch (teacher.value.subject) {
    case 0:
        return 'Math';
        break;
    case 1:
        return 'ELA';
        break;
    case 2:
        return 'Science';
        break;
    case 3:
        return 'Social Studies';
        break;
    case 4:
        return 'PE';
        break;
    case 5:
        return 'Writing';
        break;
    }
})
</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <div class="p-6 bg-white border-b border-gray-200 sm:flex-none">
            <div class="flex justify-center">
                <div class="flex flex-col md:flex-row md:max-w-xl min-w-full h-58 rounded-lg bg-white shadow-lg mb-8 sm:w-0">
                    <img class="w-full md:h-auto object-cover md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg" :src="teacher.avatar" :alt="teacher.fname + ' ' + teacher.lname +' avatar'" />
                    <div class="p-6 flex flex-col justify-start">
                    <h2 class="text-gray-900 text-3xl font-medium mb-2">{{ teacher.fname }} {{ teacher.lname }}</h2>
                    <div class="px-4 text-lg font-semibold">Teacher Information:</div>
                        <div class="bg-gray-100 px-4 py-4 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4 lg:gap-8">
                            <div class="text-gray-700 text-base mb-4">Grade: <span class="mx-4">{{ grade }}</span></div>
                            <div class="text-gray-700 text-base mb-4">Subject: <span class="mx-4">{{ subject }}</span></div>
                            <div class="text-gray-600 text-base mb-4">{{ teacher.teacheremail }}</div>
                        </div>
                        <div class="px-4 mt-4 text-md font-semibold">Coach Information:</div>
                        <div class="px-4 pt-4 bg-gray-100 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 lg:gap-8">
                            <div class="text-gray-700 text-base mb-4">{{ teacher.coachfname }} {{ teacher.coachlname }}</div>
                            <div class="text-gray-600 text-base mb-4">{{ teacher.coachemail }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>