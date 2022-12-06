export interface LoginData {
    email: string;
    password: string;
    remember: boolean;
    _method?: string;
}

export interface RegisterData {
    name: string;
    email: string;
    password: string;
    password_confirmation: string; 
    _method?: string;
}

export interface Errors {
    email: string[];
    password: string[];
    name: string[];
    password_confirmation: string[];
    message: string[];
}

export interface User {
    id: number;
    name: string;
    email: string;
    image_path: string;
    is_admin: boolean;
    created_at: string;
    updated_at: string;

}
