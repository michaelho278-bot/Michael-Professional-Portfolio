export class ProductImageService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl; // 例如 "/api"
    }

    // 上傳圖片
    async upload(productId, file) {
        const formData = new FormData();
        formData.append("image", file);

        try {
            const response = await fetch(`${this.baseUrl}/otherapi.php?id=${productId}`, {
                method: "POST",
                body: formData,
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token")
                }
            });

            const data = await response.text();
            if (!response.ok) {
                return { error: data.message || "Upload failed" };
            }
            return data;
        } catch (err) {
            return { error: err.message };
        }
    }

    // 刪除圖片
    async delete(productId) {
        try {
            const response = await fetch(`${this.baseUrl}/otherapi.php?id=${productId}`, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + localStorage.getItem("token")
                }
            });
            const data = await response.json();
            if (!response.ok) {
                return { error: data.message || "Delete failed" };
            }
            return data;
        } catch (err) {
            return { error: err.message };
        }
    }
}
