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


