<div {{ $attributes->merge([
    'class' => 'my-10',
]) }}
    x-data="{
        cards: @entangle($attributes->wire('model')),
        inputValue: null,
        addCard() {
            if (this.cards.includes(this.inputValue)) return;

            this.cards = [...this.cards, this.inputValue];
            this.inputValue = null;
        },
        remove(card) {
            console.log('remove card', card);
            const index = this.cards.indexOf(card);
            this.cards.splice(index, 1);
        }
    }">
    <div class="text-2xl">Cards</div>

    <div class="flex p-2 items-center flex-wrap">
        <template x-for="card of cards">
            <div
                class="relative group cursor-pointer rounded-md mr-2 mb-2 bg-white bg-opacity-50 hover:bg-opacity-100 transition duration-100 font-bold text-black py-1 px-2">
                <span x-text="card"></span>
                <div @click="remove(card)"
                    class="hidden group-hover:flex absolute -top-2.5 z-10 -right-2 items-center w-5 h-5 rounded-full justify-center p-1 bg-gray-700">
                    <x-icon.x class="text-white" />
                </div>
            </div>
        </template>
        <input type="text"
            placeholder="Add card..."
            x-model="inputValue"
            maxlength="3"
            @keyup.enter="addCard"
            class="w-[70px] mb-2 block bg-transparent text-sm border-0 ring-0 outline-none focus:outline-none p-0 focus:border-0 focus:ring-0">
    </div>
</div>
