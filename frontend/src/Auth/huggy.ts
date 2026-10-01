import axios from "axios";
import client from "@/router/client.ts";

type Lead = {
    name: string;
    email: string;
};

export const initializeHuggy = (): void => {
    if (!window.Huggy) {
        console.error("Huggy não ativado");
        return;
    }

    window.Huggy.showTrigger(28098);
}

export const subscribeLead = async (user: Lead, token: string): Promise<Lead | null> => {
    try {
        const response = await axios.post(
            client("widget-event"),
            { name: user.name, email: user.email },
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
