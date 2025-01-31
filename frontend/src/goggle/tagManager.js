export const trackEvent = (eventName, params = {}) => {
    // Facebook Pixel
    if (window.fbq) {
        window.fbq("track", eventName, params);
    } else {
        console.warn("Facebook Pixel não carregado.");
    }

    // Google Analytics
    if (window.gtag) {
        window.gtag("event", eventName, params);
    } else {
        console.warn("Google Analytics não carregado.");
    }
};
