import { reactive } from "vue";

export type ToastItem = {
    id: number;
    message: string;
};

const state = reactive({
    items: [] as ToastItem[],
});

let nextId = 0;

export const useToastState = () => state;

export const useToast = () => {
    const show = (message: string) => {
        const id = ++nextId;
        state.items.push({ id, message });
        window.setTimeout(() => {
            state.items = state.items.filter((item) => item.id !== id);
        }, 5000);
    };

    return { show, error: show };
};
