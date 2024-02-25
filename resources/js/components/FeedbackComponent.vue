<template>
    <div v-if="sending" class="spinner-overlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="container">
        <h2>Форма обратной связи</h2>

        <div v-if="isSuccess" class="alert alert-success" role="alert">
            Сообщение успешно отправлено!
        </div>
        <div v-if="isFailed" class="alert alert-danger" role="alert">
            Что-то пошло не так :(
        </div>

        <div class="mb-3">
            <label for="nameInput" class="form-label">Имя</label>
            <input v-model="name" type="text" class="form-control" id="nameInput">
            <div v-if="errors.name">
                <p v-for="item in errors.name" class="text-danger">{{ item }}</p>
            </div>
        </div>
        <div class="mb-3">
            <label for="phoneInput" class="form-label">Телефон</label>
            <input v-model="phone" type="text" class="form-control" id="phoneInput">
            <div v-if="errors.phone">
                <p v-for="item in errors.phone" class="text-danger">{{ item }}</p>
            </div>
        </div>
        <div class="mb-3">
            <label for="messageTextarea" class="form-label">Текст сообщения</label>
            <textarea v-model="message" class="form-control" id="messageTextarea" rows="3"></textarea>
            <div v-if="errors.message">
                <p v-for="item in errors.message" class="text-danger">{{ item }}</p>
            </div>
        </div>
        <button @click="send" type="button" class="btn btn-primary">Отправить</button>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            isSuccess: false,
            isFailed: false,
            name: '',
            phone: '',
            message: '',
            sending: false,
            errors: {
                name: null,
                phone: null,
                message: null,
            }
        }
    },
    methods: {
        send() {
            this.sending = true
            this.errors = {
                name: null,
                phone: null,
                message: null,
            }

            const formData = new FormData();
            formData.append('name', this.name);
            formData.append('phone', this.phone);
            formData.append('message', this.message);
            axios
                .post('/feedback', formData)
                .then(response => {
                    this.name = ''
                    this.phone = ''
                    this.message = ''
                    this.sending = false
                    this.isSuccess = true
                    setTimeout(() => this.isSuccess = false, 3000);
                })
                .catch(response => {
                    this.sending = false
                    if (response.response.status === 422) {
                        const { data } = response.response
                        this.errors = {...this.errors, ...data.errors}
                    } else {
                        this.isFailed = true
                        setTimeout(() => this.isFailed = false, 3000);
                    }
                })
        }
    }
}
</script>
