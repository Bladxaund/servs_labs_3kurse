<template>
    <div v-if="article != null" style="position: fixed; top: 20px; right: 20px; background: #2563eb; color: white; padding: 20px 30px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); z-index: 99999; border: 2px solid #ffffff; font-size: 18px;">
        🔔 Добавлена новая статья: <br>
        <strong><a :href="`/articles/${article.id}`" style="color: #fbbf24; text-decoration: underline; font-size: 20px;">{{ article.name }}</a></strong>
    </div>
</template>

<script>
export default {
    data() {
        return { article: null }
    },
    created() {
        window.Echo.channel('test').listen('NewArticleEvent', (data) => {
            console.log('Пришло событие:', data);
            this.article = data.article;
            
            // Скрываем через 10 секунд
            setTimeout(() => { this.article = null; }, 10000);
        })
    }
}
</script>