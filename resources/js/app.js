import Vue from 'vue'
import './bootstrap.js'
import dayjs from 'dayjs'
import clickOutside from './vue-directive-click-outside'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserCircle } from '@fortawesome/free-regular-svg-icons'
import { faBook, faQrcode, faHandHoldingHeart } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import TopNavigation from './components/TopNavigation'
import LoginScreen from './auth/LoginScreen'
import RegisterScreen from './auth/RegisterScreen'
import ForgotPassword from './auth/ForgotPassword'
import ConfirmPassword from './auth/ConfirmPassword'
import ResetPassword from './auth/ResetPassword'
import VerifyEmail from './auth/VerifyEmail'
import BookList from './BookList'
import BookHeader from './components/BookHeader'
import BookDetail from './components/BookDetail'

library.add(faUserCircle, faBook, faQrcode, faHandHoldingHeart)
Vue.component('font-awesome-icon', FontAwesomeIcon)

const element = document.getElementById('laravel-data')
window.Laravel = JSON.parse(element.getAttribute('data-laravel'))
if (Object.keys(window.Laravel.errors).length === 0) window.Laravel.errors = {}
element.remove()
Vue.prototype.$window = window
Vue.prototype.route = function (name, parameters) {
    if (window.Laravel.routes[name] === undefined) {
        console.error('Route not found ', name)
    } else if (window.Laravel.routes[name].uri === '//') {
        return '/'
    } else {
        const uri = new URL(
            window.Laravel.routes[name].uri
                .replace(/\{(.*?)(\?)?\}/g, (match, p1) => parameters && parameters.hasOwnProperty(p1) ? parameters[p1] : match)
                .replace(/\{.*?\}/g, match => Array.isArray(parameters) ? parameters.shift() : match)
                .replace(/\{.*?\?\}/g, ''),
            window.location.origin)

        if (parameters) {
            const mentionedParameters = (window.Laravel.routes[name].uri.match(/\{.*?\??\}/g) ?? [])
                .map(match => match.replace(/^\{|\??\}$/g, ''))
            const unmentionedParameters = Object.entries(parameters)
                .filter(([key, _]) => !mentionedParameters.includes(key))
            const queryParams = new URLSearchParams(uri.search)
            unmentionedParameters.forEach(([key, value]) => queryParams.set(key, value))
            uri.search = queryParams.toString()
        }
        return uri.toString()
    }
}
Vue.prototype.routeMethod = function (name, parameters) {
    if (window.Laravel.routes[name] === undefined) {
        console.error('Route not found ', name)
    } else {
        return window.Laravel.routes[name].method
    }
}
Vue.prototype.old = function (name, parameters) {
    if (window.Laravel.oldInput[name] === undefined) {
        return ''
    } else {
        return window.Laravel.oldInput[name]
    }
}

Vue.directive('click-outside', clickOutside)

Object.defineProperties(Vue.prototype, {
    $date: {
        get() {
            return dayjs
        }
    }
})

const app = new Vue({
    el: '#app',
    components: {
        TopNavigation,
        LoginScreen,
        RegisterScreen,
        ForgotPassword,
        ConfirmPassword,
        ResetPassword,
        VerifyEmail,
        BookList,
        BookHeader,
        BookDetail,
    }
})
