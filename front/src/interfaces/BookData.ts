import { User } from './UserData';

export interface Category {
    id: number;
    name: string;
    slug: string;
    color: string;
}

export interface librarianSearch {
    search: string;
    category: string;
}
export interface Book {
    id: number;
    quantity: number;
    title: string;
    author: string;
    publisher: string;
    isbn: string;
    description: string;
    image: string;
    categories: Category[];
    users: User[];
    users_count: number;
}

export interface Link {
    url: string;
    label: string;
    active: boolean;
}

export interface Books {
    current_page: number;
    data: Book[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: Link[];
    next_page_url?: any;
    path: string;
    per_page: number;
    prev_page_url?: any;
    to: number;
    total: number;
}

export interface BookData {
    id?: number;
    title?: string;
    quantity?: number;
    author?: string;
    publisher?: string;
    isbn?: string;
    description?: string;

}

export interface Pivot {
    created_at?: string | null;
    due_date?: string;
}



