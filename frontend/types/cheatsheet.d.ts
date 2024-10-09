export interface Category {
    '@id': string
    id: number
    name: string
}

export interface Content {
    id: string
    values: Record<string, string>
}

export interface Block {
    id: string
    title: string
    contents: Content[]
}