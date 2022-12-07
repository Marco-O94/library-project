export interface Books {
    current_page: number;
    data: Book[];
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
    
}

export interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    image: string;
    color: string;
}