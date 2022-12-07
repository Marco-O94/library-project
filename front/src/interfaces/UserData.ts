export interface Role {
    id: number;
    name: string;
    color: string;
    created_at: Date;
    updated_at: Date;
}

export interface User {
    id: number;
    name: string;
    is_admin: number;
    email: string;
    role_id: number;
    email_verified_at: Date;
    image_path: string;
    created_at: Date;
    updated_at: Date;
    role: Role;
}
