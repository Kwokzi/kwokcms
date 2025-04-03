import './bootstrap';
import './helper';//导入助手函数
import { createApp } from 'vue';

// VUE组件
import Counter from './components/Counter.vue';
// 创建并挂载计数器应用（如果挂载点存在）
if (document.getElementById('counter-app')) {
    const counterApp = createApp(Counter);
    counterApp.mount('#counter-app');
}