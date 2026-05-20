# Arquitetura Hexagonal

## Estrutura base

- `Domain`: regras de negócio puras (entidades, VOs, enums, contratos).
- `Application`: casos de uso, interfaces/ports e orquestração.
- `Infrastructure`: adapters (controllers, event listeners, persistência, integrações).

## Convenção para novos contextos

Para organizar por contexto no futuro, replicar dentro de cada contexto (ex: `Ticket`, `User`, `Auth`):

- `src/<Contexto>/Domain`
- `src/<Contexto>/Application`
- `src/<Contexto>/Infrastructure`

## Regra de dependência

- `Domain` não depende de nada externo.
- `Application` depende de `Domain`.
- `Infrastructure` implementa ports do `Application`/`Domain` e integra frameworks/libs.

## Convenção de controllers

- `Infrastructure/Controller/<Finalidade>/<Endpoint>Controller.php`
- Um controller por endpoint.
