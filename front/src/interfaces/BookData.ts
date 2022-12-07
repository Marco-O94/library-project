export interface Pivot {
    book_id: number;
    category_id: number;
}

export interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    image: string;
    color: string;
    created_at: Date;
    updated_at: Date;
    pivot: Pivot;
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
    created_at: Date;
    updated_at: Date;
    categories: Category[];
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
    next_page_url: string;
    path: string;
    per_page: number;
    prev_page_url?: any;
    to: number;
    total: number;
}

