<x-layout>
    <section class="py-8 max-w-md mx-auto">
        <h1 class="text-lg font-bold mb-4">
            Publish New Post
        </h1>
        <x-panel class="max-w-sm mx-auto">
            <form method="POST" action="/admin/posts" enctype="multipart/form-data">
                @csrf
                <x-form.input name="title" />
                <x-form.input name="slug" />
                <x-form.input name="slug" type="file"/>
                <x-form.textarea name="excerpt" />
                <x-form.textarea name="body" />
                <x-form.field>
                    <x-form.label name="category" />
                    <select name="category_id" id="category_id">
                        @foreach(\App\Models\Category::all() as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : ''}}
                            >{{ ucwords($category->name) }}</option>

                        @endforeach
                    </select>
                    <x-form.error name="category"/>
                </x-form.field>
                <x-form.buttom>Publish</x-form.buttom>
            </form>
        </x-panel>
    </section>
</x-layout>
