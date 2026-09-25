# Chain Spectator - Wireframes (Milestone 1)

All views share a common layout: a top navigation bar with the project name
and a search input, a main content area, and a minimal footer.

## Shared Layout

```
┌──────────────────────────────────────────────────────────────────┐
│  ⛓ Chain Spectator          [Search: hash / height / addr...]    │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│                        (page content)                            │
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│  Chain Spectator · Powered by Bitcoin Knots + Fulcrum            │
└──────────────────────────────────────────────────────────────────┘
```

---

## 1. Home / Landing Page (`/`)

```
┌──────────────────────────────────────────────────────────────────┐
│  ⛓ Chain Spectator          [Search: hash / height / addr...]    │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│                    ┌────────────────────────┐                    │
│                    │  🔍 Search the chain   │                    │
│                    │  [____________________]│                    │
│                    │  block hash · height · │                    │
│                    │  txid · address        │                    │
│                    └────────────────────────┘                    │
│                                                                  │
│  Latest Blocks                                                   │
│  ┌────────┬──────────┬────────┬──────────┬───────────┐           │
│  │ Height │ Time     │ Tx     │ Size     │ Miner     │           │
│  ├────────┼──────────┼────────┼──────────┼───────────┤           │
│  │ 862401 │ 3 min    │  3,241 │ 1.54 MB  │ Foundry   │           │
│  │ 862400 │ 14 min   │  2,892 │ 1.48 MB  │ AntPool   │           │
│  │ 862399 │ 22 min   │  1,547 │ 1.31 MB  │ F2Pool    │           │
│  │ 862398 │ 31 min   │  4,102 │ 1.62 MB  │ ViaBTC    │           │
│  │ 862397 │ 45 min   │  2,203 │ 1.41 MB  │ Foundry   │           │
│  │ 862396 │ 52 min   │  3,670 │ 1.55 MB  │ MARA Pool │           │
│  │ 862395 │ 1 hr     │  2,981 │ 1.50 MB  │ Foundry   │           │
│  │ 862394 │ 1 hr     │  1,893 │ 1.38 MB  │ Binance   │           │
│  │ 862393 │ 1 hr     │  3,412 │ 1.57 MB  │ AntPool   │           │
│  │ 862392 │ 2 hr     │  2,654 │ 1.44 MB  │ F2Pool    │           │
│  └────────┴──────────┴────────┴──────────┴───────────┘           │
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│  Chain Spectator · Powered by Bitcoin Knots + Fulcrum            │
└──────────────────────────────────────────────────────────────────┘
```

Each row in the table is a link to `/block/<height>`. The height column is
the most prominent. Time is relative ("3 min ago" etc.). HTMX could poll
for new blocks, but for Milestone 1 the table is static on page load.

---

## 2. Block Detail (`/block/<hash-or-height>`)

```
┌──────────────────────────────────────────────────────────────────┐
│  ⛓ Chain Spectator          [Search: hash / height / addr...]   │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│  ◀ Block 862401 ▶                                          [✕]  │
│                                                                  │
│  ┌─────────────────────────────┬─────────────────────────────┐  │
│  │ Hash                        │ Fee span                    │  │
│  │ 00000...4130d       [📋]    │ 3.1 - 412.0 sat/vB         │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Timestamp                   │ Median fee                  │  │
│  │ 2024-09-15 14:32:01         │ ~12.5 sat/vB ($1.23)        │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Size                        │ Total fees                  │  │
│  │ 1,543,218 bytes             │ 0.312 BTC ($19,422)         │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Weight                      │ Subsidy + fees              │  │
│  │ 3,993,412 WU                │ 3.437 BTC ($213,911)        │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │                             │ Miner                       │  │
│  │                             │ Foundry USA                 │  │
│  └─────────────────────────────┴─────────────────────────────┘  │
│                                                                  │
│                                                   [Details ▾]   │
│                                                                  │
│  ┌ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┐  │
│  │ Details (collapsed by default)                            │  │
│  │ ┌──────────────────────┬────────────────────────────┐     │  │
│  │ │ Version   0x20000000 │ Difficulty  57,321,508,...  │     │  │
│  │ │ Bits      0x17034219 │ Nonce       0xa3f21c08     │     │  │
│  │ │ Merkle root          │ Header hex  [↗]            │     │  │
│  │ │ 7a3b1c...e92f        │                            │     │  │
│  │ └──────────────────────┴────────────────────────────┘     │  │
│  └ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┘  │
│                                                                  │
│  3,241 transactions                          [◀ 1 2 3 ... 130 ▶]│
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ a1b2c3...f4e5                                               ││
│  │ ┌──── Inputs ─────────────┐  ┌──── Outputs ────────────────┐││
│  │ │ Coinbase                │→ │ bc1q...7x2m    3.125 BTC    │││
│  │ │                         │  │ nulldata                    │││
│  │ └─────────────────────────┘  └─────────────────────────────┘││
│  │                                                 Fee: 0 sats ││
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ d4e5f6...a7b8                                               ││
│  │ ┌──── Inputs ─────────────┐  ┌──── Outputs ────────────────┐││
│  │ │ bc1q...3k9p  0.152 BTC  │→ │ bc1q...m4n2    0.100 BTC   │││
│  │ │ bc1q...j2w7  0.031 BTC  │  │ bc1q...p8r1    0.080 BTC   │││
│  │ │                         │  │ bc1q...x5z3    0.001 BTC   │││
│  │ └─────────────────────────┘  └─────────────────────────────┘││
│  │                                     Fee: 1,820 sats (12 s/vB)│
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ ...                                                         ││
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│                                              [◀ 1 2 3 ... 130 ▶]│
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│  Chain Spectator · Powered by Bitcoin Knots + Fulcrum            │
└──────────────────────────────────────────────────────────────────┘
```

**Interaction notes:**
- ◀ ▶ arrows navigate to previous/next block (HTMX full page swap)
- [✕] returns to home
- Block hash, txids, and addresses are all clickable links
- Pagination loads the next page of transactions via HTMX (partial swap
  of the transaction list area only)
- [Details ▾] toggles the details section (HTMX swap or pure CSS toggle)

---

## 3. Transaction Detail (`/tx/<txid>`)

```
┌──────────────────────────────────────────────────────────────────┐
│  ⛓ Chain Spectator          [Search: hash / height / addr...]   │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│  Transaction                                                     │
│  a1b2c3d4...6f7e8a9b       [📋]         ┌──────────────────┐    │
│                                          │ 142 confirmations│    │
│                                          └──────────────────┘    │
│                                                                  │
│  ┌─────────────────────────────┬─────────────────────────────┐  │
│  │ Timestamp                   │ Fee                         │  │
│  │ 2024-09-15 14:32:01         │ 1,820 sats ($1.13)          │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Confirmed after             │ Fee rate                    │  │
│  │ 8 minutes                   │ 12.4 sat/vB                 │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Features                    │ Effective fee rate           │  │
│  │ SegWit  RBF                 │ 12.4 sat/vB                 │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │                             │ Miner                       │  │
│  │                             │ Foundry USA                 │  │
│  └─────────────────────────────┴─────────────────────────────┘  │
│                                                                  │
│  Inputs & Outputs                                    [Details ▾] │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │                                                              ││
│  │  ┌──── Inputs (2) ───────────┐   ┌──── Outputs (3) ────────┐││
│  │  │                           │   │                          │││
│  │  │ #0                        │   │ #0                       │││
│  │  │ bc1q...3k9p               │   │ bc1q...m4n2              │││
│  │  │ 0.15200000 BTC            │ → │ 0.10000000 BTC           │││
│  │  │ from tx:e3f4...1a2b:0     │   │                          │││
│  │  │                           │   │ #1                       │││
│  │  │ #1                        │   │ bc1q...p8r1              │││
│  │  │ bc1q...j2w7               │   │ 0.08000000 BTC           │││
│  │  │ 0.03100000 BTC            │   │                          │││
│  │  │ from tx:b7c8...9d0e:2     │   │ #2                      │││
│  │  │                           │   │ bc1q...x5z3              │││
│  │  │                           │   │ 0.00118200 BTC           │││
│  │  │                           │   │ (spent)                  │││
│  │  │                           │   │                          │││
│  │  └───────────────────────────┘   └──────────────────────────┘││
│  │                                                              ││
│  │  Total input:  0.18300000 BTC                                ││
│  │  Total output: 0.18118200 BTC                                ││
│  │  Fee:          0.00001820 BTC (1,820 sats)                   ││
│  │                                                              ││
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│  ┌ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┐  │
│  │ Details (collapsed by default)                            │  │
│  │ ┌──────────────────────┬────────────────────────────┐     │  │
│  │ │ Size       234 bytes │ Version         2          │     │  │
│  │ │ Virt. size 153 vB    │ Locktime        862,399    │     │  │
│  │ │ Weight     610 WU    │ Sigops          1          │     │  │
│  │ │                      │ Tx hex          [↗]        │     │  │
│  │ └──────────────────────┴────────────────────────────┘     │  │
│  └ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ─ ┘  │
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│  Chain Spectator · Powered by Bitcoin Knots + Fulcrum            │
└──────────────────────────────────────────────────────────────────┘
```

**Interaction notes:**
- Addresses in inputs/outputs link to `/address/<addr>`
- Source transaction references (from tx:...) link to `/tx/<txid>`
- Confirmation badge shows count + color (green if 6+, yellow if 1-5)
- For unconfirmed transactions: "First seen" + "ETA" replace
  "Timestamp" + "Confirmed after", and badge shows "Unconfirmed"

---

## 4. Address Detail (`/address/<addr>`)

```
┌──────────────────────────────────────────────────────────────────┐
│  ⛓ Chain Spectator          [Search: hash / height / addr...]   │
├──────────────────────────────────────────────────────────────────┤
│                                                                  │
│  Address                                                         │
│  bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh       [📋]        │
│                                                                  │
│  ┌─────────────────────────────┬─────────────────────────────┐  │
│  │ Confirmed balance           │ Pending                     │  │
│  │ 1.45000000 BTC ($90,219)    │ +0.05000000 BTC ($3,111)    │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Confirmed UTXOs             │ Pending UTXOs               │  │
│  │ 12                          │ +1                           │  │
│  ├─────────────────────────────┼─────────────────────────────┤  │
│  │ Total received              │ Type                        │  │
│  │ 8.21000000 BTC              │ P2WPKH (native SegWit)      │  │
│  └─────────────────────────────┴─────────────────────────────┘  │
│                                                                  │
│  42 of 156 transactions                                          │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ a1b2c3...f4e5                            2024-09-15 14:32   ││
│  │ ┌──── Inputs ─────────────┐  ┌──── Outputs ────────────────┐││
│  │ │ bc1q...3k9p  0.152 BTC  │→ │ bc1q...xy2k ★  0.100 BTC   │││
│  │ │ bc1q...j2w7  0.031 BTC  │  │ bc1q...p8r1    0.080 BTC   │││
│  │ └─────────────────────────┘  └─────────────────────────────┘││
│  │                                     Fee: 1,820 sats (12 s/vB)│
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ d4e5f6...a7b8                            2024-09-14 09:11   ││
│  │ ┌──── Inputs ─────────────┐  ┌──── Outputs ────────────────┐││
│  │ │ bc1q...xy2k ★  0.200 BTC│→ │ bc1q...r9s0    0.195 BTC   │││
│  │ └─────────────────────────┘  └─────────────────────────────┘││
│  │                                       Fee: 940 sats (6 s/vB) │
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│  ┌──────────────────────────────────────────────────────────────┐│
│  │ ...                                                         ││
│  └──────────────────────────────────────────────────────────────┘│
│                                                                  │
│                        [Load more transactions]                  │
│                                                                  │
├──────────────────────────────────────────────────────────────────┤
│  Chain Spectator · Powered by Bitcoin Knots + Fulcrum            │
└──────────────────────────────────────────────────────────────────┘
```

**Interaction notes:**
- ★ marks inputs/outputs belonging to the current address (highlighted
  visually with a background color or bold)
- Transaction cards are identical to the block detail view, but with
  the current address highlighted
- "Load more transactions" uses HTMX to append the next batch without
  full page reload (hx-get + hx-swap="beforeend")
- Address string is shown in full (not truncated) since it is the
  page's subject

---

## Mobile Layout Notes

On viewports < 768px:
- Summary tables stack vertically (single column)
- Transaction cards: inputs and outputs stack vertically instead of
  side-by-side (inputs above, arrow pointing down, outputs below)
- Navigation arrows and search move to a hamburger or simplified layout
- Latest blocks table on home: hide Size column, show only essential
  columns (Height, Time, Miner)

```
┌────────────────────────┐
│ ⛓ Chain Spectator  [≡] │
├────────────────────────┤
│                        │
│ ◀ Block 862401 ▶       │
│                        │
│ Hash                   │
│ 00000...4130d    [📋]  │
│                        │
│ Timestamp              │
│ 2024-09-15 14:32:01    │
│                        │
│ Size                   │
│ 1,543,218 bytes        │
│                        │
│ Weight                 │
│ 3,993,412 WU           │
│                        │
│ Fee span               │
│ 3.1 - 412.0 sat/vB    │
│                        │
│ Median fee             │
│ ~12.5 sat/vB ($1.23)   │
│                        │
│ Total fees             │
│ 0.312 BTC ($19,422)    │
│                        │
│ Subsidy + fees         │
│ 3.437 BTC ($213,911)   │
│                        │
│ Miner                  │
│ Foundry USA            │
│                        │
│            [Details ▾] │
│                        │
│ 3,241 transactions     │
│ [◀ 1 2 3 ... 130 ▶]   │
│                        │
│ ┌────────────────────┐ │
│ │ a1b2c3...f4e5      │ │
│ │                    │ │
│ │ Inputs             │ │
│ │ bc1q...3k9p        │ │
│ │ 0.152 BTC          │ │
│ │       ↓            │ │
│ │ Outputs            │ │
│ │ bc1q...m4n2        │ │
│ │ 0.100 BTC          │ │
│ │ bc1q...p8r1        │ │
│ │ 0.080 BTC          │ │
│ │                    │ │
│ │ Fee: 1,820 sats    │ │
│ └────────────────────┘ │
│                        │
└────────────────────────┘
```
