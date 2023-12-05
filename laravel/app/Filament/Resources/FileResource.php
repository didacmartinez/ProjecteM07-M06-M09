<?php

namespace App\Filament\Resources;

use App\Models\File;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Resources\Tables;
use Filament\Resources\Forms\Components\FileUpload;
use Filament\Resources\Tables\Columns\TextColumn;
use Filament\Resources\Tables\Actions;
use App\Filament\Resources\FileResource\Pages;

class FileResource extends Resource
{
    protected static ?string $model = File::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            FileUpload::make('filepath')->required()->image()->maxSize(2048)->directory('uploads')
                ->getUploadedFileNameForStorageUsing(fn ($file) => time() . '_' . $file->getClientOriginalName()),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('filepath')->translateLabel(),
            TextColumn::make('filesize')->translateLabel(),
            TextColumn::make('created_at')->dateTime()->translateLabel(),
            TextColumn::make('updated_at')->dateTime()->translateLabel(),
        ])->actions([
            Actions\ViewAction::make(),
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ])->bulkActions([
            Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'view' => Pages\ViewFile::route('/{record}'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }
}
