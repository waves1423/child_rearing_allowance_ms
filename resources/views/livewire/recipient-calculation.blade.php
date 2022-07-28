<div class="p-2 mx-auto">
    <div class="relative">
      <label for="type" class="leading-7 text-sm text-gray-600">種別</label>
      <select id="type" name="type" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        <option value="1">給与所得</option>
        <option value="2">年金所得</option>
        <option value="3">営業所得</option>
        <option value="4">その他所得</option>
      </select>                                             
    </div>
</div>
<div class="p-2 mx-auto">
    <div class="relative">
        <label for="income" class="leading-7 text-sm text-gray-600">所得金額</label>
        <input wire:model="income" type="number" id="income" name="income" value="{{ old('income') }}" required placeholder="円 ※10万円控除前の金額を入力して下さい" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
</div>
  <div class="p-2 mx-auto">
    <div class="relative">
      <label for="deducted_income" class="leading-7 text-sm text-gray-600">控除後所得金額</label>
      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        {{ $deducted_income }}</div>
    </div>
  </div>
  <div class="p-2 mx-auto">
    <div class="relative">
      <label for="support_payment" class="leading-7 text-sm text-gray-600">養育費</label>
      <input wire:model="support_payment" type="number" id="support_payment" name="support_payment" value="{{ old('support_payment') }}" required placeholder="円" class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    </div>
  </div>
  <div class="p-2 mx-auto">
    <div class="relative">
      <label for="deducted_support_payment" class="leading-7 text-sm text-gray-600">控除後養育費</label>
      <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
        {{ $deducted_support_payment }}</div>
    </div>
  </div>