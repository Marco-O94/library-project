import { Book } from './BookData'

export interface User {
    books: Book[];
    id: number;
    name: string;
    is_admin: boolean;
    email: string;
    role_id: number;
    image_path?: any;
    books_count: number;
    role: Role | null;
}
export interface Role {
    id: number;
    name: string;
    color: string;
}

export interface Link {
    url: string;
    label: string;
    active: boolean;
}

export interface Users {
    current_page: number;
    data: User[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: Link[];
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url?: any;
    to: number;
    total: number;
}

export interface userSearch {
    search: string;
    role: string;
}
