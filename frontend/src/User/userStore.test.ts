import { describe, it, expect, beforeEach, vi } from "vitest";
import { setActivePinia, createPinia } from "pinia";
import axios from "axios";
import { userStore } from "@/User/userStore.ts";

vi.mock("axios");

describe("User Store", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
    });

    it("Deve rejeitar o registo e guardar a mensagem real da senha curta", async () => {
        const store = userStore();
        const message = "The password field must be at least 6 characters.";

        (axios.post as any).mockRejectedValue({
            response: {
                data: {
                    message,
                    errors: {
                        password: [message],
                    },
                },
            },
        });

        await expect(store.create({
            name: "DOUGLAS DA CRUZ MARTINS",
            email: "martinsdouglas087@gmail.com",
            password: "133",
            segment_ids: [6],
        })).rejects.toBeTruthy();

        expect(store.error).toBe(message);
        expect(store.fieldErrors.password).toBe(message);
    });
});
