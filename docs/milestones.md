# Chain Spectator - Milestones

## Milestone 1: Block and Transaction Explorer (MVP)

The core value: browse confirmed blocks and their transactions. No mempool
statistics, no real-time updates, no JavaScript. Pure server-rendered HTML
served via HTMX for navigation.

### Views

#### 1.1 Block Detail (`/block/<hash-or-height>`)

A single page showing everything about a confirmed block.

**Header**
- Title "Block" + height number
- Previous / Next block navigation arrows
- Close button (back to home)

**Summary table** (two columns on desktop, stacked on mobile)

| Left column             | Right column                |
|-------------------------|-----------------------------|
| Hash (truncated + copy) | Fee span (min–max sat/vB)   |
| Timestamp               | Median fee (sat/vB + fiat)  |
| Size (bytes)            | Total fees (BTC + fiat)     |
| Weight (WU)             | Subsidy + fees (BTC + fiat) |
|                         | Miner (pool name)           |

**Details section** (toggle, collapsed by default)

| Left column    | Right column          |
|----------------|-----------------------|
| Version (hex)  | Difficulty            |
| Bits (hex)     | Nonce (hex)           |
| Merkle root    | Block header hex link |

**Transaction list**
- Count header: "N transactions"
- Paginated list of transactions (25 per page)
- Each transaction rendered as a compact card showing:
  - txid (truncated + link)
  - Inputs on the left, outputs on the right
  - Each input/output shows address (truncated) and amount (BTC)
  - Total fee and fee rate

#### 1.2 Transaction Detail (`/tx/<txid>`)

A single page showing everything about a transaction.

**Header**
- Title "Transaction"
- txid (truncated + copy button)
- Confirmation status badge (N confirmations / Unconfirmed)

**Summary table** (two columns on desktop, stacked on mobile)

If confirmed:

| Left column                  | Right column                |
|------------------------------|-----------------------------|
| Timestamp                    | Fee (sats + fiat)           |
| Confirmed after              | Fee rate (sat/vB)           |
| Features (SegWit, RBF, etc.) | Effective fee rate (sat/vB) |
|                              | Miner (pool name)           |

If unconfirmed:

| Left column        | Right column             |
|--------------------|--------------------------|
| First seen         | Fee (sats + fiat)        |
| ETA                | Fee rate (sat/vB)        |
| Features           | Effective fee rate       |

**Inputs & Outputs section**
- List of inputs: each showing previous txid:vout, address, amount
- List of outputs: each showing index, address, amount, spent/unspent status
- Total input, total output, fee summary line

**Details section** (toggle, collapsed by default)

| Left column       | Right column         |
|-------------------|----------------------|
| Size (bytes)      | Version              |
| Virtual size (vB) | Locktime             |
| Weight (WU)       | Sigops               |
|                   | Transaction hex link |

#### 1.3 Address Detail (`/address/<addr>`)

A single page showing everything about a Bitcoin address.

**Header**
- Title "Address"
- Address string (truncated + copy button)

**Summary table** (two columns on desktop, stacked on mobile)

| Left column                    | Right column                           |
|--------------------------------|----------------------------------------|
| Confirmed balance (BTC + fiat) | Pending balance (BTC + fiat)           |
| Confirmed UTXOs                | Pending UTXOs                          |
| Total received (BTC)           | Type (P2PKH, P2SH, P2WPKH, P2TR, etc.) |

**Transaction list**
- Count header: "N of M transactions"
- Paginated list of transactions involving this address
- Each transaction highlights the address's inputs/outputs
- "Load more" pagination (infinite scroll style, like mempool)

#### 1.4 Home / Landing page (`/`)

Minimal landing page. Not a mempool dashboard; just an entry point.

- Search bar: accepts block hash, block height, txid, or address
- Latest blocks list: a compact table of the last ~10 blocks
  - Height, timestamp (relative), tx count, size, miner
  - Each row links to the block detail page

### Excluded from Milestone 1

- Mempool statistics (fee histogram, pending tx count, projected blocks)
- Real-time updates (WebSocket/SSE)
- Block visualizations (the WebGL mosaic of transactions by fee)
- Block audit (expected vs actual comparison)
- RBF timeline
- Transaction flow diagram (the bowtie/Sankey)
- CPFP details
- Transaction acceleration
- Mining pool pages
- Price charts / historical data
- Multi-network support (testnet, signet, liquid)
- API endpoints for third-party consumption

### Data sources

| Data                      | Source                           |
|---------------------------|----------------------------------|
| Blocks, transactions      | Bitcoin Knots v29 RPC            |
| Address balance, UTXO set | Fulcrum (Electrum protocol)      |
| Fee estimates             | Bitcoin Knots `estimatesmartfee` |
| Fiat price (current)      | External API (TBD)               |

### Stack for Milestone 1

| Layer      | Technology                                  |
|------------|---------------------------------------------|
| Web server | Caddy (reverse proxy to PHP-FPM)            |
| Backend    | PHP 8.5, Slim 4, PHP-DI, Twig templates     |
| Frontend   | HTMX (no JS build step), plain CSS          |
| Bitcoin    | Bitcoin Knots v29 RPC                       |
| Electrum   | Fulcrum RPC                                 |
| Cache      | APCu (in-process, for RPC response caching) |
| Dev env    | Docker Compose                              |

---

## Milestone 2: Navigation Polish + Search

- Breadcrumb-style navigation: Block -> Transaction -> Address
- HTMX partial page loads for pagination (no full page reload)
- Improved search with type detection (hash vs height vs address)

## Milestone 3: Real-time & Mempool Awareness

- Fee estimation display on the landing page
- Unconfirmed transaction tracking
- SSE or polling for new block notifications
- Latest unconfirmed transactions feed
- Mempool size / fee distribution summary

## Milestone 4: Rich Visualizations

- Block fee-rate distribution chart (server-rendered SVG or lightweight JS)
- Transaction flow diagram (inputs/outputs visual)
- Mining pool identification and statistics

---

## Open Questions

1. **Fiat price API**: Which source for BTC/USD (and BTC/EUR)? Candidates:
   CoinGecko, Kraken, Bitstamp. Need historical prices for confirmed
   transactions (price at block time).
2. **Caching strategy**: How aggressively to cache RPC responses? Confirmed
   blocks are immutable, so they can be cached indefinitely. Unconfirmed
   transactions need fresh data.
3. **Database**: Milestone 1 could work without MariaDB (pure RPC + Fulcrum),
   but address history pagination and search might need a local index.
   Evaluate after Milestone 1.
4. **CSS framework**: Use something minimal (e.g. Pico CSS, Simple.css) or
   hand-roll? Mempool uses Bootstrap — we could use a lighter alternative.
