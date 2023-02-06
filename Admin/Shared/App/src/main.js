import { BehaviorSubject } from "rxjs";
import axios from 'axios';


export const auth$ = new BehaviorSubject({
    sessionToken: null,
    error: false,
    pending: false,
});


export function logout() {
    //Todo Fix this remove cooki or invalidate token on backend
    auth$.next({
        sessionToken: null,
        error: false,
    });
}

export const axiosApiInstance = axios.create();

// Request interceptor for API calls
axiosApiInstance.interceptors.request.use(
    async config => {
        const auth = auth$.getValue();

        config.headers = {
            'Authorization': `Bearer ${auth.sessionToken}`,
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        }
        return config;
    },
    error => {
        Promise.reject(error)
    });

// Response interceptor for API calls
axiosApiInstance.interceptors.response.use((response) => {
    return response
}, async function (error) {

    auth$.next({
        sessionToken: null,
        error: "Invalid user or password",
        pending: false,
    });

    return Promise.reject(error);
});