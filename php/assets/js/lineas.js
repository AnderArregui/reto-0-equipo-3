import { Application } from '@splinetool/runtime';

window.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('canvas3d');
const app = new Application(canvas);
app.load('https://prod.spline.design/QEgPTfMBcE0IMAwN/scene.splinecode');
});

