export const initializeHuggy = () => {
    if (!window.Huggy) {
        console.error("Huggy não ativado");
        return;
    }

    Huggy.showTrigger(28098);
}
export const subscribeLead = async (user, token) => {
    try {
        const response = await axios.post(
            "http://127.0.0.1:8000/api/widget-event",
            user,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": "application/json",
                },
            }
        );

        return response.data;
    } catch (error) {
        console.error("Erro ao inscrever lead:", error);
        return null;
    }
}