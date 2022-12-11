/* eslint-disable @typescript-eslint/no-explicit-any */
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
    pivot: Pivot;
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

/* LOAN INTERFACES */

export interface Loan {
    due_date: string;
    created_at?: any;
    title: string;
    name: string;
    user_image: string;
    book_image: string;
    user_id: number;
    book_id: number;
    status: string;
}

export interface Loans {
    current_page: number;
    data: Loan[];
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

export interface loansSearch {
    search_user: string;
    search_book: string;
    search_due_date: string;
    sort: string;
    
}





