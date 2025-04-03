<template>
    <div class="p-4 bg-white rounded shadow">
        <p class="text-xl mb-3">计数：{{ count }}</p>
        <button @click="increment" :disabled="isIncrementing" :class="{ 'opacity-50 cursor-not-allowed': isIncrementing }" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors" :title="isIncrementing ? '正在增加中，请稍候' : '增加'">
            {{ isIncrementing ? '正在增加中...' : '增加' }}
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const count = ref(0);
const isIncrementing = ref(false);
const apiUrl = document.getElementById('counter-app').dataset.apiUrl;
// 获取 API 路由和初始值
onMounted(async () => {
    try {
        const response = await axios.get(apiUrl);
        count.value = response.data.count;
    } catch (error) {
        console.error('获取初始值失败:', error);
    }
});

// 方法
const increment = async () => {
    isIncrementing.value = true;
    try {
        const response = await axios.post(apiUrl);
        count.value = response.data.count;
    } catch (error) {
        console.error('增加计数失败:', error);
    } finally {
        isIncrementing.value = false;
    }
};
</script>