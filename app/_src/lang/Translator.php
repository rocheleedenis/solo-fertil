<?php

class Translator
{
    /**
     * @param string $path
     *
     * @return string
     */
    public static function get($path)
    {
        $message = self::errors();

        foreach (explode('.', $path) as $index) {
            $message = $message[$index];
        }

        if (is_string($message)) {
            return $message;
        }
    }

    private static function errors()
    {
        return [
            'errors' => [
                'query_execution' => [
                    'not_found' => 'Informações não encontradas.',
                ],
            ],
            'exceptions' => [
                'query_execution' => [
                    'select' => 'Erro ao buscar informações.',
                    'save' => 'Erro ao salvar informações.',
                    'delete' => 'Erro ao remover informações.',
                ],
            ],
        ];
    }
}
