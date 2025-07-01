def findLargestNumber(array = None):
    """
    Fungsi ini mencari angka terbesar dalam sebuah array.

    :param array: List berisi angka-angka (integer)
    :return: Angka terbesar dalam array, atau pesan error jika input tidak valid
    """
    if array is None:
        return "Tidak ada data"  # Handle jika parameter tidak diberikan
    if not isinstance(array, list):
        return "Input harus berupa list"
    if not array:
        return "Tidak ada data"  # Handle jika array kosong

    return max(array) # Cari nilai maksimum dalam array

print(findLargestNumber([5, 17, 2, 89, 45]))       # Output: 89
print(findLargestNumber([1, 2, 3, 4, 5]))          # Output: 5
print(findLargestNumber([-10, -20, -5, -1]))       # Output: -1
print(findLargestNumber([100]))                    # Output: 100
print(findLargestNumber([]))                       # Output: Tidak ada data
