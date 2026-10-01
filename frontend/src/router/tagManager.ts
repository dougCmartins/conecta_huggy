export const trackEvent = (eventName: string, params: Record<string, unknown> = {}): void => {
    if (window.fbq) {
        window.fbq("track", eventName, params);
    } else {
        console.warn("Facebook Pixel não carregado.");
    }

    if (window.gtag) {
        window.gtag("event", eventName, params);
    } else {
        console.warn("Google Analytics não carregado.");
    }
};
