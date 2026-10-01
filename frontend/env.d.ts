/// <reference types="vite/client" />

interface HuggyWidget {
    showTrigger: (id: number) => void;
}

interface Window {
    Huggy?: HuggyWidget;
    fbq?: (command: string, eventName: string, params?: Record<string, unknown>) => void;
    gtag?: (command: string, eventName: string, params?: Record<string, unknown>) => void;
}
